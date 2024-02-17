# Goal:
Create an application that allows an internal user that has an  account with a PIX key configurated to send a PIX to another user, internal or external, that also has an bank account with a PIX key configured.

# Functional requirements

- An internal user has only one account by unique personal identification number - Cadastro de Pessoal Física (CPF).
- An internal user can have until 4 pix key configurated at same time.
- To send or receive a pix tranfer the account of that internal user should be active.
- To send a pix transfer the balance of that internal user account should be greather that zero brazilian reais.
- To send a pix transfer that internal user account should have at least one pix key configurated.
- To send a pix transfer the receiver account should have a pix key configurated.
- The internal user pix key can have only types cpf, brazilian cellphone, email and random.
- An internal user can have only 1 pix key by type configurated at same time. 
- Users of other payment institutions can have pix key type cnpj
- An internal user can send a pix transfer using a pix key of any type to any other type of pix key.

# Non-Functional requirements

- Apply an Clean Architecture with PHP-8.3 and Laraval framework implementation
- Use Domain-Driver Design
- Use Test-Driver Depvelopment
- Apply SOLID concepts
- Apply Clean Code concepts