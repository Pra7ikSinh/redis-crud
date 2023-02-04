<?php
    namespace App\Facades2;
    use Illuminate\Support\Facades\Facade;

    class TestFacadeClass extends Facade{
        protected static function getFacadeAccessor()
        {
            return 'testfclass';
        }
    }
?>
