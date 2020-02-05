<?php
/**
 * @see https://github.com/yiimaker/yii2-email-templates
 *
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\email\templates\models;

use yii\base\BaseObject;
use ymaker\email\templates\templates\TemplateInterface;

/**
 * Model class for template manager.
 *
 * @see \ymaker\email\templates\components\TemplateManager
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.0
 */
class EmailTemplate extends BaseObject
{
    /**
     * Email letter subject.
     *
     * @var string
     */
    private $subject;
    /**
     * Email letter body.
     *
     * @var string
     */
    private $body;

    public function subject(): string
    {
        return $this->subject;
    }

    public function body(): string
    {
        return $this->body;
    }

    /**
     * EmailTemplate constructor.
     *
     * @param string $subject
     * @param string $body
     * @param array  $config
     *
     * @since 2.0
     */
    public function __construct($subject, $body, $config = [])
    {
        $this->subject = $subject;
        $this->body = $body;

        parent::__construct($config);
    }

    /**
     * Build email template from entity.
     *
     * @param \ymaker\email\templates\entities\EmailTemplateTranslation $entity
     *
     * @return EmailTemplate
     */
    public static function buildFromEntity($entity)
    {
        return new self($entity->subject, $entity->body);
    }

    /**
     * Build email templates array from entities.
     *
     * @param \ymaker\email\templates\entities\EmailTemplateTranslation[] $entities
     *
     * @return EmailTemplate[]
     */
    public static function buildMultiply($entities)
    {
        $templates = [];

        foreach ($entities as $entity) {
            $templates[$entity->language] = static::buildFromEntity($entity);
        }

        return $templates;
    }

    /**
     * Replace keys to real data in subject and body.
     */
    public function parse(TemplateInterface $template)
    {
        $reflection = new \ReflectionClass($template);
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            foreach (['subject', 'body'] as $attribute) {
                $this->$attribute = \strtr($this->$attribute, [
                    \sprintf('{%s}', $property->getName()) => $property->getValue($template),
                ]);
            }
        }

        return $this;
    }
}
