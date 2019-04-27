<?php

namespace Jamesh\Uuid\Test;

use Illuminate\Support\Str;
use Jamesh\Uuid\Test\Models\Category;
use Jamesh\Uuid\Test\Models\Post;
use Jamesh\Uuid\Test\Models\Tag;

class HasUuidTest extends TestCase
{

    const UUID_REGEX = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

    public function test_create()
    {
        $post = Post::create(['title' => 'My awesome post']);
        $this->assertRegExp(self::UUID_REGEX, $post->id);

        $found = Post::first();
        $this->assertRegExp(self::UUID_REGEX, $found->id);
    }

    public function test_find()
    {
        $post = Post::create(['title' => 'My awesome post']);

        $found = Post::find($post->id);

        $this->assertEquals($post->id, $found->id);
        $this->assertEquals('My awesome post', $found->title);
    }

    public function test_delete()
    {
        $post = Post::create(['title' => 'My awesome post']);

        $this->assertCount(1, Post::all());

        Post::find($post->id)->delete();

        $this->assertCount(0, Post::all());
    }

    public function test_has_many()
    {
        $category = Category::create(['name' => 'Tutorial']);
        $post = Post::create(['title' => 'My awesome tutorial']);

        $category->posts()->save($post);

        $found = Post::first();

        $this->assertNotNull($found->category);
        $this->assertEquals($category->id, $found->category->id);
        $this->assertEquals('Tutorial', $found->category->name);
    }

    public function test_belongs_to()
    {
        $category = Category::create(['name' => 'Tutorial']);
        $post = Post::create(['title' => 'My awesome tutorial']);

        $post->category()->associate($category);
        $post->save();

        $found = Post::first();

        $this->assertNotNull($found->category);
        $this->assertEquals($category->id, $found->category->id);
        $this->assertEquals('Tutorial', $found->category->name);
    }

    public function test_many_to_many()
    {
        $post = Post::create(['title' => 'My awesome tutorial']);

        $post->tags()->attach(Tag::create(['name' => 'PHP']));
        $found = Post::first();

        $this->assertCount(1, $found->tags);

        $post->tags()->attach(Tag::create(['name' => 'Laravel']));
        $post->tags()->attach(Tag::create(['name' => 'Uuid']));
        $found = Post::first();

        $this->assertCount(3, $found->tags);
    }

    public function test_is_failed_when_update_id()
    {
        $post = Post::create(['title' => 'My awesome tutorial']);

        $original_id = $post->id;
        $new_id = (string)Str::uuid();

        $post->id = $new_id;
        $post->save();

        $found = Post::first();
        $this->assertEquals($original_id, $found->id);

        $post->update(['id' => $new_id]);

        $found = Post::first();
        $this->assertEquals($original_id, $found->id);
    }

    public function test_save_new_with_empty_id()
    {
        $post = new Post();
        $post->id = '';
        $post->title = 'My awesome tutorial';
        $post->save();

        $found = Post::first();

        $this->assertNotEmpty($found->id);
        $this->assertNotNull($found->id);
        $this->assertRegExp(self::UUID_REGEX, $found->id);
    }

    public function test_create_with_empty_id()
    {
        Post::unguarded(function () {
            Post::create([
                'id' => '',
                'title' => 'My awesome tutorial'
            ]);

            $found = Post::first();

            $this->assertNotEmpty($found->id);
            $this->assertNotNull($found->id);
            $this->assertRegExp(self::UUID_REGEX, $found->id);
        });
    }
}
