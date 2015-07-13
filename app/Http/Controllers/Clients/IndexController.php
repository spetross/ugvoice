<?php

namespace app\Http\Controllers\Clients;

use app\Http\Controllers\AppController;
use app\Repositories\OrganisationRepository;


/**
 * Class IndexController
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Http\Controllers\Clients
 */
class IndexController extends AppController
{

    public function __construct(OrganisationRepository $repository)
    {
        parent::__construct();
        $this->clientsProvider = $repository;
    }


    public function index()
    {
        $organisations = $this->clientsProvider->paginate(16);
        return $this->render('clients.index', compact('organisations'));
    }

    public function search()
    {
        return $this->render('clients.list', compact('clients'));
    }


}