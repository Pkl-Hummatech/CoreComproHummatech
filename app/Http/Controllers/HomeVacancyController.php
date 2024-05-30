<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\BackgroundInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\VacancyInterface;
use App\Contracts\Interfaces\WorkFlowInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeVacancyController extends Controller
{
    private VacancyInterface $vacancyData;
    private WorkFlowInterface $workflow;
    private BackgroundInterface $background;

    /**
     * Constructor for the class.
     *
     * @param VacancyInterface $vacancyInterface the data vacancy from database.
     */
    public function __construct(VacancyInterface $vacancyInterface , WorkFlowInterface $workflow, BackgroundInterface $background)
    {
        $this->vacancyData = $vacancyInterface;
        $this->workflow = $workflow;
        $this->background = $background;
    }

    /**
     * Autorun the controller to view Vacancy Page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(): View
    {
        $workflows = $this->workflow->get();
        $vacancyData = $this->vacancyData->get();
        $background = $this->background->getByType('Lowongan');

        return view('landing.vacancy.index', compact('vacancyData' ,'workflows', 'background'));
    }
}
