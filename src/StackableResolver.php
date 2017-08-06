<?php

namespace yswery\DNS;

class StackableResolver
{

    /**
     * @var array
     */
    protected $resolvers;

    public function __construct(array $resolvers = array())
    {
        $this->resolvers = $resolvers;
    }

    public function get_answer($question)
    {
        foreach ($this->resolvers as $resolver) {
            $answer = $resolver->get_answer($question);
            if ($answer) {
                return $answer;
            }
        }

        return array();
    }

    /**
     * Check if any resolver knows about a domain
     *
     * @param  string  $domain the domain to check for
     * @return boolean         true if some resolver holds info about $domain
     */
    public function is_authority($domain) {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->is_authority($domain)) {
                return true;
            }
        }
        return false;
    }
}
