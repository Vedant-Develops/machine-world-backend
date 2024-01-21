<?php

namespace App\Containers\AppSection\Products\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Products\Tasks\CreateProductsTask;
use App\Containers\AppSection\Products\UI\API\Requests\CreateProductsRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use carbon;

class CreateProductsAction extends ParentAction
{
    use HashIdTrait;
    public function run(CreateProductsRequest $request, $InputData)
    {
        $product_type_id = $this->decode($InputData->getProductType());

        // Product Image
        if ($InputData->getProductImage() != null) {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($InputData->getProductImage());
            if (!file_exists(public_path('product_images/'))) {
                mkdir(public_path('product_images/'), 0755, true);
            }
            $image_type = "png";
            $folderPath = 'api/public/product_images/';
            $file = uniqid() . '.' . $image_type;
            $saveimage = $image->toPng()->save(public_path('product_images/' . $file));
            $product_image  =  $folderPath . $file;
        } else {
            $product_image = '';
        }

        // Product Video
        if (!empty($_FILES['product_video'])) {
            if ($_FILES['product_video']['error'] === UPLOAD_ERR_OK) {
                $video = $_FILES['product_video']['tmp_name'];
                if (!file_exists(public_path('product_videos/'))) {
                    mkdir(public_path('product_videos/'), 0755, true);
                }
                $folderPath = 'api/public/product_videos/';
                $file = $_FILES['product_video']['name'];
                $savevideo = move_uploaded_file($video, public_path('product_videos/' . $file));
                $product_video  =  $folderPath . $file;
            } else {
                $product_video = '';
            }
        } else {
            $product_video = '';
        }

        $data = $request->sanitizeInput([
            'name' => $InputData->getName(),
            'height' => $InputData->getHeight(),
            'width' => $InputData->getWidth(),
            'length' => $InputData->getLength(),
            'weight' => $InputData->getWeight(),
            'power' => $InputData->getPower(),
            'product_specification' => $InputData->getProductSpecification(),
            'motor_type' => $InputData->getMotorType(),
            'diagram_type' => $InputData->getDiagramType(),
            'diagram_value' => $InputData->getDiagramValue(),
            'price' => $InputData->getPrice(),
            'is_active' => 1,
        ]);
        $data['product_type_id'] = $product_type_id;
        $data['product_image'] = $product_image;
        $data['product_video'] = $product_video;


        return app(CreateProductsTask::class)->run($data);
    }
}
