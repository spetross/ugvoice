<?php namespace app\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginRequiredException extends \UnexpectedValueException
{
}

class PasswordRequiredException extends \UnexpectedValueException
{
}

class UserAlreadyActivatedException extends \RuntimeException
{
}

class UserNotFoundException extends \OutOfBoundsException
{
}

class UserNotActivatedException extends \RuntimeException
{
}

class UserExistsException extends \UnexpectedValueException
{
}

class WrongPasswordException extends UserNotFoundException
{
}

class GroupExistsException extends \UnexpectedValueException
{
}

class GroupNotFoundException extends \UnexpectedValueException
{
}

class NameRequiredException extends \UnexpectedValueException
{
}

class OrganisationNotFoundException extends ModelNotFoundException
{
}

class UserBannedException extends \RuntimeException
{
}

class UserSuspendedException extends \RuntimeException
{
}

class ArticleNotFoundException extends ModelNotFoundException
{
}

