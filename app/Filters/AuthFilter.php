<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('auth/login'))->with('error', 'Please login to access this page.');
        }

        if ($arguments && in_array('admin', $arguments)) {
            if ($session->get('role') !== 'admin') {
                return redirect()->to(base_url())->with('error', 'Access denied. Admin only.');
            }
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
