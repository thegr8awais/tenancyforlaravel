<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createTenant(Request $request)
    {

        $name = "foo";
        $central = config('tenancy.central_domains')[0];
        $domain = $name .".". $central;

        if(Tenant::where('id',$name)->doesntExist()){
            $tenant = Tenant::create([
                'id' => $name,
                'name' => $name .' Tenant',
            ]);
            $tenant->domains()->create(['domain' => $domain]);
        }
        $tenantUrl = tenant_route($domain, 'tenant.home');

        return view('welcome',compact('domain', 'tenantUrl'));


    }
}
