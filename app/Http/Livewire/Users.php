<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Users extends Component
{
    public $name;
    public $email;
    public $countries;
    public $states;
    public $cities;


    public $selectedCountry = null;
    public $selectedState = null;
    public $selectedCity = null;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'selectedCountry' => 'required',
        'selectedState' => 'required',
        'selectedCity' => 'required'

    ];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.users')->extends('layouts.app');
    }

    public function updatedSelectedCountry($value)
    {
        $this->states = State::whereHas('country', function ($query) use ($value) {
            $query->whereId($value);
        })->pluck('name', 'id');
    }

    public function updatedSelectedState($value)
    {
        $this->cities = City::whereHas('state', function ($query) use ($value) {
            $query->whereId($value);
        })->pluck('name', 'id');
    }

    public function save()
    {
        $this->validate();

        $payload = [
            'name' => $this->name,
            'email' => $this->email,
            'country_id' => $this->selectedCountry,
            'state_id' => $this->selectedState,
            'city_id' => $this->selectedCity,
        ];

        User::create($payload);
        Session::flash('message', 'Data updated successfully.');

        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = "";
        $this->email = "";
        $this->countries = $this->countries;
        $this->selectedCountry = null;
        $this->selectedState = null;
        $this->selectedCity = null;
    }
}
