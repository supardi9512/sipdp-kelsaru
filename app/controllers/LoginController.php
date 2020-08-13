<?php

class LoginController extends Controller {
    public function index()
    {
        if(isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/home');
            exit;
        }

        $data['title'] = 'Login';

        $this->view('auth/login', $data);
    }

    public function login()
    {
        if(isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/home');
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == '' || $password == '') {
            Flasher::setOldData('username', $username);

            if($username == '') {
                Flasher::setError('Masukkan username Anda!', 'danger', 'username');
            }

            if($password == '') {
                Flasher::setError('Masukkan password Anda!', 'danger', 'password');
            }

            header('Location: '.BASEURL.'/login');
            exit;
        } else {
            // CEK LOGIN ADMIN 
            $data['username_admin'] = $this->model('LoginModel')->getByUsername('m_admin', $username);
            
            if(!empty($data['username_admin'])) {
                $data['password_admin'] = $this->model('LoginModel')->getByUsernameAndPassword('m_admin', $username, $password);
        
                if(!empty($data['password_admin'])) {
                    $_SESSION['is_login'] = TRUE;
                    $_SESSION['id'] = $data['username_admin']['id_admin'];
                    $_SESSION['nama'] = $data['username_admin']['nama_admin'];
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = 'admin';
            
                    header('Location: '.BASEURL.'/home');
                    exit;
                } else {
                    Flasher::setOldData('username', $username);
                    Flasher::setError('Password yang Anda masukkan salah!', 'danger', 'password');
                    
                    header('Location: '.BASEURL.'/login');
                    exit;
                }
            } else {
                // CEK LOGIN RW 

                $data['username_rw'] = $this->model('LoginModel')->getByUsername('m_rw', $username);
            
                if(!empty($data['username_rw'])) {
                    $data['password_rw'] = $this->model('LoginModel')->getByUsernameAndPassword('m_rw', $username, $password);
                
                    if(!empty($data['password_rw'])) {
                        $_SESSION['is_login'] = TRUE;
                        $_SESSION['id'] = $data['username_rw']['id_rw'];
                        $_SESSION['nama'] = $data['username_rw']['nama_rw'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = 'rw';
                
                        header('Location: '.BASEURL.'/home');
                        exit;
                    } else {
                        Flasher::setOldData('username', $username);
                        Flasher::setError('Password yang Anda masukkan salah!', 'danger', 'password');
                        
                        header('Location: '.BASEURL.'/login');
                        exit;
                    }
                } else {
                    // CEK LOGIN RT 

                    $data['username_rt'] = $this->model('LoginModel')->getByUsername('m_rt', $username);
            
                    if(!empty($data['username_rt'])) {
                        $data['password_rt'] = $this->model('LoginModel')->getByUsernameAndPassword('m_rt', $username, $password);
                    
                        if(!empty($data['password_rt'])) {
                            $_SESSION['is_login'] = TRUE;
                            $_SESSION['id'] = $data['username_rt']['id_rt'];
                            $_SESSION['nama'] = $data['username_rt']['nama_rt'];
                            $_SESSION['username'] = $username;
                            $_SESSION['level'] = 'rt';
                    
                            header('Location: '.BASEURL.'/home');
                            exit;
                        } else {
                            Flasher::setOldData('username', $username);
                            Flasher::setError('Password yang Anda masukkan salah!', 'danger', 'password');
                            
                            header('Location: '.BASEURL.'/login');
                            exit;
                        }
                    } else {
                        // CEK LOGIN PENDUDUK 

                        $data['username_penduduk'] = $this->model('LoginModel')->getByUsername('m_penduduk', $username);
                
                        if(!empty($data['username_penduduk'])) {
                            $data['password_penduduk'] = $this->model('LoginModel')->getByUsernameAndPassword('m_penduduk', $username, $password);
                           
                            if(!empty($data['password_penduduk'])) {
                                $_SESSION['is_login'] = TRUE;
                                $_SESSION['id'] = $data['username_penduduk']['nik'];
                                $_SESSION['nama'] = $data['username_penduduk']['nama_penduduk'];
                                $_SESSION['username'] = $username;
                                $_SESSION['level'] = 'penduduk';
                        
                                header('Location: '.BASEURL.'/home');
                                exit;
                            } else {
                                Flasher::setOldData('username', $username);
                                Flasher::setError('Password yang Anda masukkan salah!', 'danger', 'password');
                                
                                header('Location: '.BASEURL.'/login');
                                exit;
                            }
                        } else {
                            Flasher::setError('Username yang Anda masukkan salah!', 'danger', 'username');
                                
                            header('Location: '.BASEURL.'/login');
                            exit;
                        }
                    }
                }
            }
        }

    }

    public function logout()
    {
        unset($_SESSION['is_login']);
        unset($_SESSION['id']);
        unset($_SESSION['nama']);
        unset($_SESSION['username']);
        unset($_SESSION['level']);

        header('Location: '.BASEURL.'/login');
        exit;
    }
}