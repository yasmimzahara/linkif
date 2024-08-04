

## TODO
- student
    - "quero essa vaga": cria application + gera pdf + envia por email para empresa
- company
    - enviar criação de senha por e-mail (companies && students)
    - editar próprio endereço e CompanyInfo
    - crud internships
        - bug: nas vagas do admin e da empresa "Selecionar Superintendente" => "Selecionar curso"
- tentar deletar tudo tudo tudo
- revisar cruds abaixo



## admin
- crud users
    - crud admin
    - crud aluno
    - crud empresa (sem senha, pede para trocar senha por email)
- demais cruds

## tela aluno
-  tela 1
    - nome da empresa
    - informações sobre estagio
    - filtro
- tela 2 (curriculo)
    - (um monte de campo dane-se)
- vê vagas, clicar em "quero essa vaga": envia pdf com curriculo por e-mail para empresa

## tela empresa
- editar próprios dados
- login, trocar senha, logout
- crud vagas
    - tempo pré-determinado para aparecer candidatos

- users
    - type
    - password
    - email
- resumes
    - descriptions
    - user_id
- company_infos
    - fancy_name
    - phone
    - cnpj
    - address_id
    - user_id
- internships
    - expires_at
    - requirements
    - integration_agency
    - supervisor?
    - course_id
    - title
    - workload
    - shift (enum: day, afternoon, night)
    - description
    - wage
    - address_id
    - user_id (empresa)
- applications
    - user_id (aluno)
    - job_id
- courses
    - name
- addresses
    - street
    - number
    - zip_code (cep)
    - neighborhood
    - city
    - country
   - state



editor WYSIWYG: https://github.com/slab/quill (é o que tem mais estrelas)
ícones: https://heroicons.com/
`php artisan db:wipe; php artisan migrate; php artisan db:seed`

## nao feito
- mudar data das migrations
- select com ajax
- trucar nomes grandes
- ordenar busca por campos

## dificil de explicar
- left join + add select => posso deixar N+
- Searchable trait
- middlewares
- resources e escolhas nas rotas


