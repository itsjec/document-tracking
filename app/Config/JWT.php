namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig
{
    /**
     * JWT secret key
     *
     * @var string
     */
    public $key = 'abcd1234';

    /**
     * JWT supported algorithms
     *
     * @var array
     */
    public $supportedAlgs = ['HS256'];

    /**
     * JWT expiration time (in seconds)
     *
     * @var int
     */
    public $jwt_expiration = 3600; // 1 hour
}
