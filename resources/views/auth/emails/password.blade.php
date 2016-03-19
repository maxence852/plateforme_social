Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'emails'.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
