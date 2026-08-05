<?php

namespace Tests\Feature;

use App\Models\HeroSlide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HeroSlideTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->syncPermissions([Permission::firstOrCreate(['name' => 'manage hero'])]);

        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    public function test_admin_can_access_hero_index(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.hero.index'))
            ->assertOk()
            ->assertSee('Hero Slider');
    }

    public function test_admin_can_create_hero_slide_without_image(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.hero.store'), [
                'title' => 'Slide Uji',
                'subtitle' => 'Subjudul uji',
                'active' => '1',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.hero.index'));

        $this->assertDatabaseHas('hero_slides', [
            'title' => 'Slide Uji',
            'active' => true,
            'sort_order' => 1,
        ]);
    }

    public function test_admin_can_upload_hero_slide_image(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post(route('admin.hero.store'), [
                'title' => 'Slide Foto',
                'image' => UploadedFile::fake()->image('hero.jpg'),
            ]);

        $slide = HeroSlide::first();
        $this->assertNotNull($slide->image);
        Storage::disk('public')->assertExists($slide->image);
    }

    public function test_admin_can_update_and_delete_hero_slide(): void
    {
        $slide = HeroSlide::factory()->create(['title' => 'Sebelum']);

        $this->actingAs($this->admin())
            ->put(route('admin.hero.update', $slide), [
                'title' => 'Sesudah',
                'active' => '0',
                'sort_order' => 2,
            ])
            ->assertRedirect(route('admin.hero.index'));

        $this->assertDatabaseHas('hero_slides', ['id' => $slide->id, 'title' => 'Sesudah', 'active' => false]);

        $this->actingAs($this->admin())
            ->delete(route('admin.hero.destroy', $slide))
            ->assertRedirect(route('admin.hero.index'));

        $this->assertSoftDeleted('hero_slides', ['id' => $slide->id]);
    }

    public function test_home_renders_active_hero_slides_with_fallback_url(): void
    {
        HeroSlide::factory()->create(['title' => 'Slide Beranda', 'image' => null, 'active' => true, 'sort_order' => 1]);
        HeroSlide::factory()->create(['active' => false]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Slide Beranda')
            ->assertSee('picsum.photos');
    }

    public function test_guest_cannot_access_hero_admin(): void
    {
        $this->get(route('admin.hero.index'))->assertRedirect(route('login'));
    }
}
