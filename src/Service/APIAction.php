<?php

namespace RoryLeeton\DummyUserManager\Service;

enum APIAction: string {
    case GET_USER = 'get-user';
    case GET_USERS = 'get-users';
    case CREATE_USER = 'create-user';
}