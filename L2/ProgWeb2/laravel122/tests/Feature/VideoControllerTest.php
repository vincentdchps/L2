use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

public function test_admin_can_store_video_with_image()
{
    Storage::fake('public');

    
    $file = UploadedFile::fake()->image('miniature.jpg');

    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)->post(route('admin.videos.store'), [
        'title' => 'Ma nouvelle vidéo',
        'url' => 'https://youtube.com/...',
        'image' => $file,
    ]);

    
    Storage::disk('public')->assertExists('images/' . $file->hashName());
    
    $response->assertRedirect(route('admin.videos.index'));
}
