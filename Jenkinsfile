pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'composer install --no-interaction'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}