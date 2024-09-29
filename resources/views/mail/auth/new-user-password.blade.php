<x-mail::message>
# Bem-vinda ao Linkif!

Para completar seu cadastro, crie uma senha clicando no link abaixo 👇🥰

<x-mail::button :url="route('new-user-password.create', ['user' => $userId, 'token' => $token])">
Cadastrar senha
</x-mail::button>

Obrigada,<br>
{{ config('app.name') }}
</x-mail::message>
