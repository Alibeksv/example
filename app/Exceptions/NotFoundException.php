<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class NotFoundException extends \Exception
{
    public function render()
    {
        $message = $this->getMessage() ?? 'Not found';

        return response()->json(
            [
                'message' => $message
            ],
            Response::HTTP_NOT_FOUND
        );
    }
}
