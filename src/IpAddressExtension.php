<?php

declare(strict_types=1);

namespace Archette\IpAddress;

use Doctrine\Common\Persistence\Mapping\Driver\AnnotationDriver;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Rixafy\IpAddress\IpAddressFacade;
use Rixafy\IpAddress\IpAddressFactory;
use Rixafy\IpAddress\IpAddressRepository;
use Rixafy\IpAddress\IpAddressResolver;

class IpAddressExtension extends CompilerExtension
{
	public function beforeCompile(): void
	{
		/** @var ServiceDefinition $annotationDriver */
		$annotationDriver = $this->getContainerBuilder()->getDefinitionByType(AnnotationDriver::class);
		$annotationDriver->addSetup('addPaths', [['vendor/rixafy/ip-address']]);
	}

	public function loadConfiguration(): void
	{
		$this->getContainerBuilder()->addDefinition($this->prefix('ipAddressFactory'))
			->setFactory(IpAddressFactory::class);

		$this->getContainerBuilder()->addDefinition($this->prefix('ipAddressRepository'))
			->setFactory(IpAddressRepository::class);

		$this->getContainerBuilder()->addDefinition($this->prefix('ipAddressFacade'))
			->setFactory(IpAddressFacade::class);

		$this->getContainerBuilder()->addDefinition($this->prefix('ipAddressResolver'))
			->setFactory(IpAddressResolver::class);
	}
}
