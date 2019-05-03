<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Transformers\UserTransformer;
use App\Services\UserService;
use App\Exceptions\User\UserNotFoundException;

/**
 * @Resource("Users", uri="/users")
 */
class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * List all users
     *
     * Get a JSON representation of all the registered users.
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Response(200, body={
     *    "current_page": 1,
     *    "data": {
     *       {
     *           "id": 1,
     *           "name": "John Doe",
     *           "age": 35,
     *           "email": "john.doe@gmail.com",
     *           "created_at": "2019-01-01 00:00:00",
     *           "updated_at": "2019-01-01 00:00:00"
     *       }
     *   },
     *   "first_page_url": "http://api.users.local/users?page=1",
     *   "from": 1,
     *   "last_page": 1,
     *   "last_page_url": "http://api.users.local/users?page=1",
     *   "next_page_url": null,
     *   "path": "http://api.users.local/users",
     *   "per_page": 10,
     *   "prev_page_url": null,
     *   "to": 1,
     *   "total": 1
     * })
     */
    public function list(Request $request)
    {
        return $this->response->item(
            $this->userService->listUsers(),
            new UserTransformer
        );
    }

    /**
     * Get specified user
     *
     * Get a JSON representation of specified user.
     *
     * @Get("/{userId}")
     * @Versions({"v1"})
     * @Response(200, body={
     *    "data": {
     *        "id": 1,
     *        "name": "John Doe",
     *        "age": 35,
     *        "email": "john.doe@gmail.com",
     *        "created_at": "2019-01-01 00:00:00",
     *        "updated_at": "2019-01-01 00:00:00"
     *    }
     * })
     */
    public function get($userId)
    {
        try {
            return $this->response->item(
                $this->userService->getUser($userId),
                new UserTransformer
            );
        } catch (UserNotFoundException $e) {
            return $this->response->error(
                $e->getMessage(),
                Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Create an user
     *
     * Register a new user entity.
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"name": "Foo Bar", "age": 20, "email": "foo@bar.com"})
     * @Response(201, body={
     *    "data": {
     *        "id": 1,
     *        "name": "Foo Bar",
     *        "age": 20,
     *        "email": "foo@bar.com",
     *        "created_at": "2019-01-01 00:00:00",
     *        "updated_at": "2019-01-01 00:00:00",
     *    }
     * })
     */
    public function create(Request $request)
    {
        $validatedUserData = $this->validate($request, [
            'name' => 'required|string',
            'age' => 'required|numeric|min:0|max:99',
            'email' => 'required|email|unique:user,email',
        ]);

        $user = $this->userService->createUser($validatedUserData);

        return $this->response->item($user, new UserTransformer)
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Delete an user
     *
     * Remove an existing user entity.
     *
     * @Delete("/{userId}")
     * @Versions({"v1"})
     * @Response(204)
     */
    public function delete($userId)
    {
        try {
            $this->userService->deleteUser($userId);

            return $this->response->noContent();
        } catch (UserNotFoundException $e) {
            return $this->response->error(
                $e->getMessage(),
                Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an user
     *
     * Update all or some user data.
     *
     * @Patch("/{userId}")
     * @Versions({"v1"})
     * @Request({"age": 30})
     * @Response(204)
     */
    public function update(Request $request, $userId)
    {
        $validatedUserData = $this->validate($request, [
            'name' => 'string',
            'age' => 'numeric|min:0|max:99',
            'email' => 'email|unique:user,email',
        ]);

        try {
            $this->userService->updateUser($userId, $validatedUserData);

            return $this->response->noContent();
        } catch (UserNotFoundException $e) {
            return $this->response->error(
                $e->getMessage(),
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
