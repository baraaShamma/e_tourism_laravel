<?php

namespace App\Requests\Admin\Bus;

use App\Requests\BaseRequestFormApi;

class AssignDriverRequest extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'bus_id' => 'required|exists:tourist_buses,id',
            'user_id' => 'required|exists:users,id,type_user,driver',
        ];
    }
        // دالة للحصول على bus_id
        public function getBusId()
        {
            return $this->request()->input('bus_id');
        }
    
        // دالة للحصول على user_id
        public function getUserId()
        {
            return $this->request()->input('user_id');
        }
}
