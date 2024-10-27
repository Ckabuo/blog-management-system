<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users
        $viewUser = Permission::create(['name' => 'view.users']);
        $updateUser = Permission::create(['name' => 'update.user']);
        $deleteUser = Permission::create(['name' => 'delete.user']);

        //Post
        $createPost = Permission::create(['name' => 'create-post']);
        $viewPost = Permission::create(['name' => 'view-post']);
        $updatePost = Permission::create(['name' => 'update-post']);
        $deletePost = Permission::create(['name' => 'delete-post']);

        // Comments
        $viewComment = Permission::create(['name' => 'view.comments']);
        $createComment = Permission::create(['name' => 'create.comments']);
        $updateComment = Permission::create(['name' => 'update.comments']);
        $deleteComment = Permission::create(['name' => 'delete.comments']);

        // User management
        $manageUser = Permission::create(['name' => 'manage.users']);

        // Post management
        $managePost = Permission::create(['name' => 'manage.posts']);

        // Comment management
        $manageComment = Permission::create(['name' => 'manage.comments']);

        $superAdmin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo([$viewUser, $updateUser, $createPost, $viewPost, $updatePost, $deletePost, $viewComment,$createComment, $updateComment, $deleteComment]);
        $user->givePermissionTo([$viewComment, $createComment, $updateComment, $deleteComment, $updateUser, $deleteUser, $viewPost]);
    }
}
