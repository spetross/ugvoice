<?php namespace app\Http\Controllers\Clients;

use app\Repositories\FileRepository;

class AdminController extends ClientController
{

    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct($fileRepository);
        $this->theme->layout('clients.dashboard');
    }

    public function dashboard()
    {
        return $this->render('client.dashboard');
    }

}
