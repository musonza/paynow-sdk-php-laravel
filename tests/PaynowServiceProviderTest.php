<?php

namespace Musonza\Paynow\Test;

use Musonza\Paynow\PaynowFacade as Paynow;
use Musonza\Paynow\PaynowServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Container\Container;

class PaynowServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testFacadeCanBeResolvedToServiceInstance()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);
        Paynow::setFacadeApplication($app);

        $payment = Paynow::createPayment('Invoice 35', 'user@example.com');
        $this->assertInstanceOf('Paynow\Payments\FluentBuilder', $payment);
    }

    public function testRegisterPaynowServiceProviderWithPackageConfigAndEnv()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        $paynow = $app['paynow'];
        $payment = $paynow->createPayment('Invoice 35', 'user@example.com');

        $this->assertInstanceOf('Paynow\Payments\FluentBuilder', $payment);
        $this->assertEquals('http://example.com/gateways/paynow/update', $paynow->getReturnUrl());
        $this->assertEquals('http://example.com/return?gateway=paynow', $paynow-> getResultUrl());
    }

    public function testServiceNameIsProvided()
    {
        $app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('paynow', $provider->provides());
    }

    protected function setupApplication()
    {
        $app = new Application();
        $app->setBasePath(sys_get_temp_dir());
        $app->instance('config', new Repository());
        return $app;
    }

    /**
     * @param Container $app
     *
     * @return PaynowServiceProvider
     */
    private function setupServiceProvider(Container $app)
    {
        $provider = new PaynowServiceProvider($app);
        $app->register($provider);
        $provider->boot();
        return $provider;
    }
}
