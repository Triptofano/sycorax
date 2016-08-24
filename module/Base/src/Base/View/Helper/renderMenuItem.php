<?php
namespace CVSBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

class renderMenuItem extends AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    protected $em;
       
    public function __invoke($value) 
    {
        $config = $this->getServiceLocator()->getServiceLocator()->get('Config');
        $menus = $config['menu'];
        
        $this->em = $this->getServiceLocator()->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        $repoRole = $this->em->getRepository('CVSAcl\Entity\Role');
        $role = $repoRole->findOneBy(array('name' => $value));
        
        #foreach($roles as $role)
        #{
        #    $repoPrivilege = $this->em->getRepository('CVSAcl\Entity\Privilege');
        #    $privileges += $repoPrivilege->findBy(array('role' => $resource[0]->getId()));
        #}
        
        $menuItem = '';
        foreach($menus as $menu)
        {
            #var_dump($menu);
            $repoResource = $this->em->getRepository('CVSAcl\Entity\Resource');
            $resource = $repoResource->findBy(array('name' => $menu['resource']));
            
            if($resource)
            {
                $repoPrivilege = $this->em->getRepository('CVSAcl\Entity\Privilege');
                $privileges = $repoPrivilege->findBy(array('resource' => $resource[0]->getId(), 'role' => $role->getId()));
                if($privileges)
                {
                    $menuItem .= '<li class="has-sub">
                                    <a href="javascript:;" class="">
                                        <span class="icon-box"><i class="'.$menu['icon'].'"></i></span>'.$menu['name'].'
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub">';

                    foreach($privileges as $link)
                    {
                        #var_dump($link);
                        #if($link->getRole()->getName() == $value)
                        {
                            $menuItem .= '<li><a class="" href="/' .
                                            $menu['route'] . '/' . $menu['actions'][$link->getName()] .
                                    '">' . $link->getName() . '</a></li>';
                        }
                    }

                    $menuItem .= '</ul>
                                </li>';
                }
            }
        }        
        return $menuItem;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;  
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;  
        return $this;  
    }
}

