<?php

namespace RoryLeeton\DummyUserManager\Service;

/**
 * Enumeration of available API actions.
 *
 * This enum represents the different types of API operations that can be
 * performed, each mapped to a string value used for processor selection
 * in the APIProcessorFactory.
 */
enum APIAction: string {
    case GET_USER = 'get-user';
    case GET_USERS = 'get-users';
    case CREATE_USER = 'create-user';
}