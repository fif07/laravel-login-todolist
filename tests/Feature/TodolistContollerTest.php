<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistContollerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "afif",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Saputra"
                ],
                [
                    "id" => "2",
                    "todo" => "Afif"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Saputra")
            ->assertSeeText("2")
            ->assertSeeText("Afif");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "afif"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "afif"
        ])->post("/todolist", [
            "todo" => "Saputra"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "afif",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Saputra"
                ],
                [
                    "id" => "2",
                    "todo" => "Afif"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
