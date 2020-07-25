import { render, useState } from '@wordpress/element'
import domReady from '@wordpress/dom-ready';
import {Notice, Dashicon, Button, Modal,Card,CardBody} from '@wordpress/components';


const App = () => {
    const [ isOpen, setOpen ] = useState( false );
    const openModal = () => setOpen( true );
    const closeModal = () => setOpen( false );
    return <>
    <Notice>
        Welcome To react Class <Dashicon icon="smiley" />
    </Notice>
    { isOpen && (
        <Modal
        title="This is my modal"
        onRequestClose={ closeModal }>
                    <Button isSecondary onClick={ closeModal }>
                        My custom close button
                    </Button>
                </Modal>
        ) }
        <Card>
            <CardBody>
                <Button isSecondary onClick={ openModal }>Show Me Popup</Button>
            </CardBody>
        </Card>
    </>;
}

domReady(function () {
    if ('undefined' !== typeof document.getElementById('wp-react-plugin-test-app') && null !== document.getElementById('wp-react-plugin-test-app')) {
        render(<App />, document.getElementById('wp-react-plugin-test-app'));
    }
});
