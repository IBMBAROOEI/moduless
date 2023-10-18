<?php




namespace barooei\User\Http\Controllers;

use App\Http\Controllers\Controller;
use barooei\User\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\VersionTrait;

class ControllreVerify extends Controller
{


    public function verify(){

        return \app\Helper\handleStatusCodes(Response::HTTP_OK, '', []);

    }

}
