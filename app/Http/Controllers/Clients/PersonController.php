<?php


namespace app\Http\Controllers\Clients;


use app\Repositories\FileRepository;

class PersonController extends ClientController
{

    public function __construct(
        FileRepository $repository
    )
    {
        parent::__construct($repository);
        $this->theme->layout('clients.dashboard');
    }

    public function index()
    {
        return $this->render('client.people.index', compact('counselors'));
    }

    public function add()
    {
        return $this->render('client.people.add');
    }
}