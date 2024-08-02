<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface RequestDashboardInterface
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules():array;
    public function authorize():bool;

    /**
     * @param array|string $keys
     * @return mixed
     */
    public function only($keys);

    /**
     * @param $key
     * @param $default
     * @return array|UploadedFile|UploadedFile[]|null
     */
    public function file($key = null,$default = null);
    public function get(string $key, mixed $default = null):mixed;
    public function validate(array $rules, ...$params);
}
