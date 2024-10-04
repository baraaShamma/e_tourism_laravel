<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseRequestFormApi
{
    protected $_request;
    private $status = true;
    private $errors = [];
    private $validatedData = [];

    abstract public function rules(): array;

    public function __construct(Request $request = null, $forceDie = true)
    {
        if (!is_null($request)) {
            $this->_request = $request;
            $rules = $this->rules();

            // Perform validation
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $this->status = false;
                $this->errors = $validator->errors()->toArray();
                if ($forceDie) {
                    // يمكنك تنفيذ منطق إضافي هنا إذا كنت تريد إيقاف التنفيذ عند وجود خطأ
                }
            } else {
                // Save validated data if validation passes
                $this->validatedData = $validator->validated();
            }
        }
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setRequest($request)
    {
        $this->_request = $request;
    }

    public function request()
    {
        return $this->_request;
    }

    // Manually add validated() method
    public function validated()
    {
        return $this->validatedData;
    }
}
