use App\Http\Controllers\NfeController;
use Illuminate\Support\Facades\Route;

// Apenas para definir o endpoint da API
Route::get('/nfe/{id}', [NfeController::class, 'show']);
