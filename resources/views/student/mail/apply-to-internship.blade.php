<x-mail::message>
# Novo candidato!

O(a) estudante {{ $application->student->name }} candidatou-se para a vaga {{ $application->internship->name }}!

Segue em anexo o currículo do(a) candidato(a).

Obrigada,<br>
{{ config('app.name') }}
</x-mail::message>
