<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 */

namespace Filth\RedisBrowserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller managing RedisBrowser
 *
 * @author Alex Tabaksmann <alxtbk@googlemail.com>
 */
class RedisBrowserController extends Controller
{
    /**
     * Init client list
     *
     * @return array
     */
    private function getClients()
    {
        $aliases = $this->container->getParameter('filth_redisbrowser_bundle_clients');

        $clients = array();
        foreach($aliases as $alias)
        {
            $clients[] = $this->get($alias['alias']);
        }

        return $clients;
    }

    /**
     * Get a value by given key and client
     *
     * @param $key
     * @param \Predis\Client $client
     * @return mixed
     */
    private function getValue($key, \Predis\Client $client)
    {
        $encoding =  $client->object('encoding', $key);

        // integer or string
        if($encoding == 'int' || $encoding == 'raw') $result = $client->get($key);

        // list
        if($encoding == 'ziplist' || $encoding == 'linkedlist' )
        {
            $result = $client->lrange($key, 0, -1);
        }

        // sorted set
        if($encoding == 'skiplist')
        {
            $result = $client->zrange($key, 0, -1);
        }

        // hashtable
        if($encoding == 'hashtable')
        {
            $result = $client->hkeys($key);
        }


        return $result;
    }

    /**
     *
     */
    public function indexAction()
    {
        $clients = $this->getClients();

        return $this->render(
            'FilthRedisBrowserBundle:RedisBrowser:index.html.twig',
            array(
                'clients' => $clients
            )
        );
    }


    public function showAction($key, $clientid)
    {
        $clients = $this->getClients();

        // get needed client by id
        $client = $clients[$clientid];

        // get value
        $result = $this->getValue($key, $client);

        $values = array();
        if(is_array($result))
        {
            foreach($result as $val)
            {
                $values[] = $val;
            }
        }
        else
        {
            $values[] = $result;
        }

        return $this->render(
            'FilthRedisBrowserBundle:RedisBrowser:show.html.twig',
            array(
                'key'    => $key,
                'values' => $values
            )
        );
    }

}
