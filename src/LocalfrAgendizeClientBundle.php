<?php

namespace Localfr\AgendizeClientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Localfr\AgendizeClientBundle\DependencyInjection\LocalfrAgendizeClientBundleExtension;

class LocalfrAgendizeClientBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     *
     * @return LocalfrAgendizeClientBundleExtension
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new LocalfrAgendizeClientBundleExtension();
        }

        return $this->extension;
    }
}
