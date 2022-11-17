import { Modal } from '@mantine/core';

const WidgetFormContainer = (props) => {
  return (
    <Modal 
      opened={props.opened} 
      onClose={() => props.closeModal()}
      title={
        (props.defaultParams ? 'Update ' : 'Create ') + 
        `${props.widgetName} widget`
      }
    >
        {props.children}
    </Modal>
  )
}

export default WidgetFormContainer;