<?php
/**
 * @see https://github.com/yiimaker/yii2-email-templates
 *
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\email\templates\repositories;

use ymaker\email\templates\entities\EmailTemplate;

/**
 * Interface of email templates repository.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 4.0
 */
interface EmailTemplatesRepositoryInterface
{
    /**
     * Find email template entity by ID.
     *
     * @param int $id
     */
    public function getById($id);

    /**
     * Find template by key with translation.
     *
     * @param string $key
     * @param string $language
     *
     * @return EmailTemplate
     */
    public function getByKeyWithTranslation($key, $language);

    /**
     * Find all language versions of template by key.
     *
     * @param string $key
     */
    public function getAll($key);

    /**
     * Returns data provider for email template entity.
     *
     * @return \yii\data\DataProviderInterface
     */
    public function getDataProvider();

    /**
     * Check whether template with current key exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * Creates new email template.
     */
    public function create();

    /**
     * Save data in entity.
     */
    public function save($entity, array $data = []);

    /**
     * Removes email template entity by ID.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id);

    /**
     * Removes email template object.
     *
     * @return bool
     */
    public function deleteObject($entity);
}
