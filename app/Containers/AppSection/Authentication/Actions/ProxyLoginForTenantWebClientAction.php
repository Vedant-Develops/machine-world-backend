<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\Tasks\ResendOtpTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
//use App\Containers\AppSection\Authentication\UI\API\Requests\TenantsLoginRequest;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Apiato\Core\Traits\HashIdTrait;

class ProxyLoginForTenantWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshCookieTask $makeRefreshCookieTask,
    ) {
    }

    /**
     * @throws LoginFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    use HashIdTrait;
    public function run(LoginProxyPasswordGrantRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                ...array_keys(config('appSection-authentication.login.attributes')),
                'password',
            ]
        );

        $userData = Tenantusers::where('email', $sanitizedData['email'])->where('is_active', 'Active')->first();
        if (!empty($userData)) {

            config(['auth.guards.api.provider' => 'tenant']);

            [$loginFieldValue] = LoginCustomAttribute::extract($sanitizedData);
            $sanitizedData = $this->enrichSanitizedData($loginFieldValue, $sanitizedData);

            $responseContent = $this->callOAuthServerTask->run($sanitizedData, $request->headers->get('accept-language'));
            $refreshCookie = $this->makeRefreshCookieTask->run($responseContent['refresh_token']);

            $responseContent['role_id'] = $this->encode($userData->role_id);
            $responseContent['user_id'] = $this->encode($userData->id);

            return [
                'response_content' => $responseContent,
                'refresh_cookie' => $refreshCookie,
            ];
        } else {
            $returnData['message'] = "User Not Found.";
            http_response_code(200);
            echo json_encode($returnData);
            exit();
        }
    }

    private function enrichSanitizedData(string $username, array $sanitizedData): array
    {
        $sanitizedData['username'] = $username;
        $sanitizedData['client_id'] = config('appSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('appSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';

        return $sanitizedData;
    }
}
