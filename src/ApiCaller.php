<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\Facades\Http;

class ApiCaller {

    public static function callEndpoint(string $endpoint, array $data = [], $headers = []) {

        $data['app_name'] = config('hyvorconnecter.app_name');
        $data['key'] = config('hyvorconnecter.api_key');

        return Http::withHeaders($headers)->get(
            url: config('hyvorconnecter.url') . '/api/auth' . $endpoint,
            query: $data
        );

    }

}