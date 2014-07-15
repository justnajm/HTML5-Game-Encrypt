HTML5-Game-Encrypt
==================

Encrypt the game values and pass them safely to server, currently stable with length of 9 characters.


How to use
----------

1. At client side javascript/game , add the function from index.html

2. Call encrypt(<YOUR_VALUE>,<YOUR_PASSWORD>)

3. Send the generated code to server using ajax or url

4. At the server side call matchCode(<GENERATED_CODE>,<YOUR_PRESET_PASSWORD>)

5. It will return decrypted value, which you can store in database or for calculating something

6. Optional, you can pass actual value at the end of generated code to match against its encryption

Example
-------
1. Deploy the code on php server

2. Point your url to index.html

3. It will redirect you to decrypt.php