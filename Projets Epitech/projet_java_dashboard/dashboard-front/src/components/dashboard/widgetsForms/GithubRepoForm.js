import { useForm } from '@mantine/form';

import { Button, Center, TextInput, NumberInput } from '@mantine/core';
import GithubRepoWidget from '../widgets/GithubRepoWidget';

const GithubRepoForm = ({widgetType, defaultParams, onWidgetAdded, onWigetUpdated}) => {
  const form = useForm({
    initialValues: {
      username: defaultParams ? defaultParams.username : '',
      repository: defaultParams ? defaultParams.repository: '',
      timer: defaultParams ? defaultParams.timer : 60.0
    },
  
    validate: {
      username: value => (
        /^[a-zA-ZÀ-ÿ\d]{0,38}$/.test(value) ? null : 'Invalid Github username'
      ),
      repository: value => (
        /^[a-zA-Z\d]+$/.test(value) ? null : 'Invalid Github repository name'
      )
    }
  });

  const onFormSumbitValidated = (values) => {
    const timer = values.time;
    delete values.timer;

    if (defaultParams)
      onWigetUpdated(timer, values);
    else
      onWidgetAdded(widgetType, timer, <GithubRepoWidget />, values);
  }

  return (
    <form onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}>
      <TextInput
        withAsterisk
        required={true}
        label='Github username'
        {...form.getInputProps('username')}
      />
      <TextInput
        withAsterisk
        required={true}
        label='Repository name'
        {...form.getInputProps('repository')}
        style={{marginTop: '0.5em'}}
      />
      <NumberInput
        withAsterisk
        required={true}
        label='Relaod time'
        description='Seconds'
        min={0}
        {...form.getInputProps('timer')}
      />
      <Center style={{marginTop: '1em'}}>
        <Button type='submit' color='teal'>
            {defaultParams ? 'Update' : 'Create'}
        </Button>
      </Center>
    </form>
  )
}

export default GithubRepoForm;