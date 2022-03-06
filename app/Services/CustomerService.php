<?php
namespace App\Services;

use App\Customer;
use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CustomerService
{
	/**
     * @var $customerRepository
     */
    protected $customerRepository;

    /**
     * CustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get all customer.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->customerRepository->getAllCustomer();
    }

    /**
     * Get customer by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->customerRepository->getById($id);
    }

    /**
     * Validate customer data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveCustomerData($data)
    {
        $validator = Validator::make($data, [
            //insert your validations here
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->customerRepository->save($data);

        return $result;
    }

    /**
     * Update customer data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateCustomer($data, $id)
    {
        $validator = Validator::make($data, [
           //insert your validations here
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $customer = $this->customerRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }

        DB::commit();

        return $customer;

    }

    /**
     * Delete customer by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $customer = $this->customerRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $customer;

    }

}
