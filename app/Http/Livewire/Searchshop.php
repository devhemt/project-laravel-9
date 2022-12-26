<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Searchshop extends Component
{
    public $searching = "";
    public $autoSearch;
    public $style1,$style2,$style3,$style4,$style5;

    public function search(){
        $this->emit('searchResult', $this->autoSearch);
    }

    public function onlNull(){
        $this->style1 = null;
        $this->style2 = null;
        $this->style3 = null;
        $this->style4 = null;
        $this->style5 = null;
    }

    public function find($category){
        switch ($category) {
            case 1:
                if ($this->searching == "Man clothing"){
                    $this->searching = null;
                    $this->onlNull();
                    $category = 0;
                    break;
                }
                $this->searching = "Man clothing";
                $this->onlNull();
                $this->style1 = 700;
                break;
            case 2:
                if ($this->searching == "Women clothing"){
                    $this->searching = null;
                    $this->onlNull();
                    $category = 0;
                    break;
                }
                $this->searching = "Women clothing";
                $this->onlNull();
                $this->style2 = 700;
                break;
            case 3:
                if ($this->searching == "Kid clothing"){
                    $this->searching = null;
                    $this->onlNull();
                    $category = 0;
                    break;
                }
                $this->searching = "Kid clothing";
                $this->onlNull();
                $this->style3 = 700;
                break;
            case 4:
                if ($this->searching == "Accessories clothing"){
                    $this->searching = null;
                    $this->onlNull();
                    $category = 0;
                    break;
                }
                $this->searching = "Accessories clothing";
                $this->onlNull();
                $this->style4 = 700;
                break;
            case 5:
                if ($this->searching == "Others clothing"){
                    $this->searching = null;
                    $this->onlNull();
                    $category = 0;
                    break;
                }
                $this->searching = "Others clothing";
                $this->onlNull();
                $this->style5 = 700;
                break;
        }
        $this->emit('CategorySearch', $category);
    }

    public function render()
    {
        return view('livewire.client.searchshop');
    }
}
