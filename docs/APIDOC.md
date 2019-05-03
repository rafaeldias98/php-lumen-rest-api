FORMAT: 1A

# Users API

# Users [/users]

## List all users [GET /users]
Get a JSON representation of all the registered users.

+ Response 200 (application/json)
    + Body

            {
                "current_page": 1,
                "data": [
                    {
                        "id": 1,
                        "name": "John Doe",
                        "age": 35,
                        "email": "john.doe@gmail.com",
                        "created_at": "2019-01-01 00:00:00",
                        "updated_at": "2019-01-01 00:00:00"
                    }
                ],
                "first_page_url": "http://api.users.local/users?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http://api.users.local/users?page=1",
                "next_page_url": null,
                "path": "http://api.users.local/users",
                "per_page": 10,
                "prev_page_url": null,
                "to": 1,
                "total": 1
            }

## Get specified user [GET /users/{userId}]
Get a JSON representation of specified user.

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 1,
                    "name": "John Doe",
                    "age": 35,
                    "email": "john.doe@gmail.com",
                    "created_at": "2019-01-01 00:00:00",
                    "updated_at": "2019-01-01 00:00:00"
                }
            }

## Create an user [POST /users]
Register a new user entity.

+ Request (application/json)
    + Body

            {
                "name": "Foo Bar",
                "age": 20,
                "email": "foo@bar.com"
            }

+ Response 201 (application/json)
    + Body

            {
                "data": {
                    "id": 1,
                    "name": "Foo Bar",
                    "age": 20,
                    "email": "foo@bar.com",
                    "created_at": "2019-01-01 00:00:00",
                    "updated_at": "2019-01-01 00:00:00"
                }
            }

## Delete an user [DELETE /users/{userId}]
Remove an existing user entity.

+ Response 204 (application/json)

## Update an user [PATCH /users/{userId}]
Update all or some user data.

+ Request (application/json)
    + Body

            {
                "age": 30
            }

+ Response 204 (application/json)