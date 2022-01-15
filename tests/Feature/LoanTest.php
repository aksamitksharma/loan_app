<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoanTest extends TestCase
{
    /**
     * Test loan request
     *
     * @return void
     */
    public function test_loan_request()
    {
        $user = User::find(1);
        $token = $user->createToken('LoanApp')->accessToken;
        $post_data = ['loan_amount' => 10000, 'loan_term' => 5];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token,])->post('/api/loans', $post_data);
        $api_return_value = $response->json()['success'];
        $this->assertEquals(1, $api_return_value);
    }

    /**
     * Test repayment success
     *
     * @return void
     */
    public function test_loan_repayment_success()
    {
        $user = User::find(1);
        $token = $user->createToken('LoanApp')->accessToken;

        $post_data = ['repay_amount' => 2000, 'loan_id' => 1];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token,])->post('/api/loan-repayment', $post_data);
        $api_return_value = $response->json()['success'];
        $this->assertTrue($api_return_value);
    }

    /**
     * Test repayment error
     *
     * @return void
     */
    public function test_loan_repayment_fail()
    {
        $user = User::find(1);
        $token = $user->createToken('LoanApp')->accessToken;
        $post_data = ['repay_amount' => 20000000, 'loan_id' => 1];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token,])->post('/api/loan-repayment', $post_data);
        $api_return_value = $response->json()['success'];
        $this->assertFalse($api_return_value);
    }
}
