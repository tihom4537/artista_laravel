<?PHP
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserInformation;
use App\Models\User;

class UserInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Fetch users sequentially based on their id
        $user = User::find($this->faker->numberBetween(1, 25));

        return [
            'user_id' => $user->id, // Assign a user_id from the retrieved user
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_no' => $this->faker->phoneNumber(), 
            'house_no_building' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'pin' => $this->faker->postcode(),
            'profile_photo' => $this->faker->imageUrl()
        ];
    }
}
