<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\adminModel;

class LoggedInRedirectFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        helper('cookie');
        $rememberId = get_cookie('remember_id');
        $rememberToken = get_cookie('remember_token');

        if ($rememberId && $rememberToken) {
            $adminModel = new adminModel();
            $admin = $adminModel->find($rememberId);

            if ($admin && $admin['remember_token'] !== null && hash_equals($rememberToken, $admin['remember_token'])) {
                session()->set([
                    'isLoggedIn' => true,
                    'adminId' => $admin['id_admin'],
                    'usernameAdmin' => $admin['username'],
                    'emailAdmin' => $admin['email'],
                ]);

                return redirect()->to('/dashboard');
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
