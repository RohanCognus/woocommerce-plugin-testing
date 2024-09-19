#!/usr/bin/env bash

if [ $# -lt 5 ]; then
    echo "usage: $0 <db-name> <db-user> <db-pass> <db-host> <wp-version> [skip-database]"
    exit 1
fi

DB_NAME=$1
DB_USER=$2
DB_PASS=$3
DB_HOST=$4
WP_VERSION=$5
SKIP_DB=${6:-false}

# set up a temporary directory
TMPDIR=${TMPDIR:-/tmp}
WP_CORE_DIR=$TMPDIR/wordpress/
WP_TESTS_DIR=$TMPDIR/wordpress-tests-lib/

# download WordPress core
download() {
    if [ -z `which curl` ]; then
        wget -nv -O $2 $1
    else
        curl -s -o $2 $1
    fi
}

if [ ! -d $WP_CORE_DIR ]; then
    mkdir -p $WP_CORE_DIR
    download https://wordpress.org/wordpress-$WP_VERSION.tar.gz $TMPDIR/wordpress.tar.gz
    tar --strip-components=1 -zxmf $TMPDIR/wordpress.tar.gz -C $WP_CORE_DIR
fi

# download the test suite
if [ ! -d $WP_TESTS_DIR ]; then
    mkdir -p $WP_TESTS_DIR
    svn co --quiet https://develop.svn.wordpress.org/trunk/tests/phpunit/includes/ $WP_TESTS_DIR/includes
    svn co --quiet https://develop.svn.wordpress.org/trunk/tests/phpunit/data/ $WP_TESTS_DIR/data
fi

# set up the wp-tests-config.php file
if [ ! -f $WP_TESTS_DIR/wp-tests-config.php ]; then
    cp $WP_TESTS_DIR/wp-tests-config-sample.php $WP_TESTS_DIR/wp-tests-config.php
    sed -i "s/youremptytestdbnamehere/$DB_NAME/" $WP_TESTS_DIR/wp-tests-config.php
    sed -i "s/yourusernamehere/$DB_USER/" $WP_TESTS_DIR/wp-tests-config.php
    sed -i "s/yourpasswordhere/$DB_PASS/" $WP_TESTS_DIR/wp-tests-config.php
    sed -i "s|localhost|$DB_HOST|" $WP_TESTS_DIR/wp-tests-config.php
fi

# create database
if [ "$SKIP_DB" = "false" ]; then
    mysqladmin create $DB_NAME --user="$DB_USER" --password="$DB_PASS" --host="$DB_HOST"
fi
