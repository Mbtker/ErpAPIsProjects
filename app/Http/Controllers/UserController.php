<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function LoginFunc(Request $request)
    {
        $Username = $request->Username;
        $Password = $request->Password;

        $Result = DB::table('users')->where('Username', '=', $Username)->where('Password', '=', $Password)->first();

        if ($Result) {
            return ['Id' => $Result->Id, 'Name' => $Result->Name];
        } else {
            return ['Id' => null];
        }
    }

    public function GetObjectType(Request $request)
    {
        return DB::table('objecttype')->get();
    }

    public function CreateObjectType(Request $request)
    {
        DB::table('objecttype')->insert([
            'objectTypeEnDesc' => $request->objectTypeEnDesc,
            'objectTypeArDesc' => $request->objectTypeArDesc,
            'securityDataType' => $request->securityDataType
        ]);

        return ['status' => true];
    }


    public function SearchObjectType(Request $request)
    {
        // $MyArray = DB::select('SELECT * FROM objecttype obj WHERE obj.objectTypeEnDesc LIKE :objectTypeEnDesc OR obj.objectTypeArDesc LIKE :objectTypeArDesc OR obj.securityDataType = :securityDataType', [$request->objectTypeEnDesc, $request->objectTypeArDesc, $request->securityDataType]);

        return DB::table('objecttype')
            ->orWhere('objectTypeEnDesc', '=', $request->objectTypeEnDesc)
            ->orWhere('objectTypeArDesc', '=', $request->objectTypeArDesc)
            ->get();

    }

    public function EditObjectType(Request $request)
    {
        DB::table('objecttype')
            ->where('Id', '=', $request->id)
            ->update([
                'objectTypeEnDesc' => $request->objectTypeEnDesc,
                'objectTypeArDesc' => $request->objectTypeArDesc,
                'securityDataType' => $request->securityDataType
            ]);
        return ['status' => true];
    }

    public function GetObjectData(Request $request)
    {
        $MyArray = DB::table('objectdata')->get();
        for($y = 0; $y<count($MyArray); $y++) {
            $GetObjectTypeId = $MyArray[$y]->objectType;
            $MyArray[$y]->objectType = DB::table('objecttype')->where('id' , $GetObjectTypeId)->first();
        }
        return $MyArray;
    }

    public function CreateObjectData(Request $request)
    {
        DB::table('objectdata')->insert([
            'objectType' => $request->objectType['id'],
            'objectUserCode' => $request->objectUserCode,
            'objectEnDescription' => $request->objectEnDescription,
            'objectArDescription' => $request->objectArDescription,
            'objectArShortDescription' => $request->objectArShortDescription
        ]);

        return ['status' => true];
    }


    public function SearchObjectData(Request $request)
    {
        // $MyArray = DB::select('SELECT * FROM objecttype obj WHERE obj.objectTypeEnDesc LIKE :objectTypeEnDesc OR obj.objectTypeArDesc LIKE :objectTypeArDesc OR obj.securityDataType = :securityDataType', [$request->objectTypeEnDesc, $request->objectTypeArDesc, $request->securityDataType]);

        $MyArray = DB::table('objectdata')
            ->orWhere('objectType', '=', $request->objectType['id'])
            ->orWhere('objectEnDescription', '=', $request->objectEnDescription)
            ->orWhere('objectArDescription', '=', $request->objectArDescription)
            ->get();
        for($y = 0; $y<count($MyArray); $y++) {
            $GetObjectTypeId = $MyArray[$y]->objectType;
            $MyArray[$y]->objectType = DB::table('objecttype')->where('id' , $GetObjectTypeId)->first();
        }
        return $MyArray;

    }

    public function EditObjectData(Request $request)
    {
        DB::table('objectdata')
            ->where('Id', '=', $request->id)
            ->update([
                'objectType' => $request->objectType['id'],
                'objectUserCode' => $request->objectUserCode,
                'objectEnDescription' => $request->objectEnDescription,
                'objectArDescription' => $request->objectArDescription,
                'objectArShortDescription' => $request->objectArShortDescription
            ]);
        return ['status' => true];
    }

}
