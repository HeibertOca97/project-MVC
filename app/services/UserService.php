<?php namespace app\services;

use app\models\User;
use app\exceptions\BusinessLogicException;
use app\exceptions\ValidationException;

class UserService{

    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Crea un nuevo usuario después de la validación.
     *
     * @param array $data Datos del usuario.
     * @return bool
     * @throws ValidationException
     * @throws BusinessLogicException
     */

    public function createUser(array $data)
    {
        // Validar datos
        $this->validateUserData($data);

        // Procesar datos si es necesario
        $processedData = $this->processUserData($data);

        // Verificar si el correo electrónico es único
        if (!$this->user->checkUniqueEmail($processedData['email'])) {
            throw new BusinessLogicException('El correo electrónico ya está en uso.');
        }

        // Crear el usuario
        return $this->user->create($processedData);
    }

    /**
     * Valida los datos del usuario.
     *
     * @param array $data Datos del usuario.
     * @throws ValidationException
     */
    protected function validateUserData(array $data)
    {
        if (empty($data['email']) || empty($data['password'])) {
            throw new ValidationException('El correo electrónico y la contraseña son obligatorios.');
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('El correo electrónico no es válido.');
        }
    }

    /**
     * Procesa y sanitiza los datos del usuario.
     *
     * @param array $data Datos del usuario.
     * @return array Datos procesados.
     */
    protected function processUserData(array $data)
    {
        // Aquí podrías realizar cualquier procesamiento adicional.
        return $data;
    }

    /**
     * Valida las credenciales del usuario y establece la sesión.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function validateUserCredentials(string $email, string $password): bool
    {
        if ($this->user->validationSessionCredential($email, $password)) {
            return true;
        }

        return false;
    }

}