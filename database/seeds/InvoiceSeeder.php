<?php

use App\Models\Invoice;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ar_SA');
        for ($i=0; $i < 15 ; $i++) {

            $items = [
                [
                    'product_name'  => 'طاولة كمبيوتر كبيرة',
                    'unit'  => 'piece',
                    'quantity'  => '2',
                    'unit_price'    => '560',
                    'row_sub_total' => '1120',
                ],[
                    'product_name'  => 'طاولة كمبيوتر صغيرة',
                    'unit'  => 'piece',
                    'quantity'  => '1',
                    'unit_price'    => '220',
                    'row_sub_total' => '220',
                ],[
                    'product_name'  => 'كمبيوتر محمول',
                    'unit'  => 'piece',
                    'quantity'  => '1',
                    'unit_price'    => '4500',
                    'row_sub_total' => '4500',
                ]
            ];
            $data['customer_name']  = $faker->name();
            $data['customer_email'] = $faker->email;
            $data['customer_mobile']    = $faker->phoneNumber;
            $data['company_name']   = $faker->name();
            $data['invoice_number'] = $i+1;
            $data['invoice_date']   = Carbon::now()->subDays(rand(1,20));
            $data['sub_total']  = '5848';
            $data['discount_type']  = 'fixed';
            $data['discount_value']  = '0';
            $data['vat_value']  = '292';
            $data['shipping']   = '100';
            $data['total_due']  = '6232';

            $invoive = Invoice::create($data);
            $invoive->details()->createMany($items);


        }
    }

}
