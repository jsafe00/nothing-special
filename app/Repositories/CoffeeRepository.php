<?php
namespace App\Repositories;

use App\Coffee;

class CoffeeRepository
{
	 /**
     * @var Coffee
     */
    protected $coffee;

    /**
     * Coffee constructor.
     *
     * @param Coffee $coffee
     */
    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    /**
     * Get all coffee.
     *
     * @return Coffee $coffee
     */
    public function getAllCoffee()
    {
        return $this->coffee
            ->get();
    }

     /**
     * Get coffee by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->coffee
            ->where('id', $id)
            ->get();
    }

    /**
     * Save Coffee
     *
     * @param $data
     * @return Coffee
     */
     public function save($data)
    {
        $coffee = new $this->coffee;

        //insert your data here

        $coffee->save();

        return $coffee->fresh();
    }

     /**
     * Update Coffee
     *
     * @param $data
     * @return Coffee
     */
    public function update($data, $id)
    {
        
        $coffee = $this->coffee->find($id);

         //insert your data here

        $coffee->update();

        return $coffee;
    }

    /**
     * Delete Coffee
     *
     * @param $data
     * @return Coffee
     */
   	 public function delete($id)
    {
        
        $coffee = $this->coffee->find($id);
        $coffee->delete();

        return $coffee;
    } 
}
