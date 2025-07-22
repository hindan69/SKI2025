<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
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
        if (!session('id')) {
            return redirect()->to(base_url('/login'));
        }

        $role = session('role');

        // Definisikan hak akses untuk masing-masing role
        $access = [
            2 => ['/tu', '/cTim'],
            3 => ['/pm', '/soal_pengungkit', '/soal_hasil', '/dash_pm'],
            4 => ['/pm', '/soal_pengungkit', '/soal_hasil', '/dash_pm', '/prfl_satker'],
            5 => ['/prfl'],
        ];

        // Cek apakah rute yang diminta ada dalam hak akses role
        $currentRoute = $request->getUri()->getPath();
        log_message('info', 'Current route: ' . $currentRoute);

        if (!isset($access[$role]) || !in_array($currentRoute, $access[$role])) {
            return redirect()->to(base_url('/blank')); // Arahkan ke halaman tidak berwenang
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
